# USAGE
# python predict.py --image images/dog.jpg --model output/simple_nn.model --label-bin output/simple_nn_lb.pickle --width 32 --height 32 --flatten 1
# python predict.py --image images/dog.jpg --model output/smallvggnet.model --label-bin output/smallvggnet_lb.pickle --width 64 --height 64
# python crack_predict.py --model output/Model_new_5.h5 --image crack_images/tile_12.jpg
# python crack_predict2.py --model output/Model_new_5.h5 --image_path crack_images
# import the necessary packages
from keras.models import load_model
from keras.utils import plot_model
import argparse
import pickle
import cv2
import numpy as np
import json
import glob
import os


def crack_predict(img, model):
	image = img.copy()
	if image.shape[0] < 100:
		image = np.concatenate((image, image), axis=0)	
	if image.shape[1] < 100:
		image = np.concatenate((image, image), axis=1)	
	#print(image.shape)
	image = image.reshape((1, image.shape[0], image.shape[1], image.shape[2]))
	# load the model and label binarizer
	#lb = pickle.loads(open(args["label_bin"], "rb").read())

	# make a prediction on the image
	preds = model.predict(image)

	#print(preds)
	return [preds[0][1]]

def crack_matrix(image_height, image_width, tile_height, tile_width):
	i = 0
	m = []
	while i < image_height:
		j = 0
		n = []
		while j < image_width:
			n.append(0)
			j += tile_width
		m.append(n)
		i += tile_height
	return m


# construct the argument parser and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-i", "--image_path", required=True,
	help="path to input image we are going to classify")
ap.add_argument("-m", "--model", required=True,
	help="path to trained Keras model")
#ap.add_argument("-w", "--width", type=int, default=28,
#	help="target spatial dimension width")
#ap.add_argument("-e", "--height", type=int, default=28,
#	help="target spatial dimension height")
ap.add_argument("-f", "--flatten", type=int, default=-1,
	help="whether or not we should flatten the image")
args = vars(ap.parse_args())

path = args["image_path"]

tile_height = 100
tile_width = 100

# load the input image and resize it to the target spatial dimensions


#image = cv2.resize(image, (args["width"], args["height"]))
#cv2.waitKey(0)
# scale the pixel values to [0, 1]
#image = image.astype("float") / 255.0

# check to see if we should flatten the image and add a batch
# dimension
#if args["flatten"] > 0:
#	image = image.flatten()
#	image = image.reshape((1, image.shape[0]))

# otherwise, we must be working with a CNN -- don't flatten the
# image, simply add the batch dimension
#else:
#	image = image.reshape((1, image.shape[0], image.shape[1],
#		image.shape[2]))

# load the model and label binarizer


#print("[INFO] loading network and label binarizer...")
model = load_model(args["model"])


plot_model(model, to_file='model.png')


err = 1

def get_batches(si, sj, image):
	image_height = image.shape[0]
	image_width = image.shape[1]
	i = si
	patches = np.empty((0, tile_height, tile_width, image.shape[2]), int)
	while i < image_height:
		j = sj
		while j < image_width:
			img = image[i:i+tile_height, j:j+tile_width].copy()
			if img.shape[0] < tile_height:
				img = np.concatenate((img, img), axis=0)	
			if img.shape[1] < tile_width:
				img = np.concatenate((img, img), axis=1)	
			#img = img.reshape((1, img.shape[0], img.shape[1], img.shape[2]))
			patches = np.append(patches, [img], axis=0)
			j += tile_width//2			
		i += tile_height//2
	return patches

def scan_predicts(si, sj, image, prediction):
	image_height = image.shape[0]
	image_width = image.shape[1]
	i = si
	index = 0;
	c_matrix = crack_matrix(image_height, image_width, tile_height//2, tile_width//2)

	while i < image_height:
		j = sj
		while j < image_width:
			c = prediction[index][1]
			if c >= 0.9:
				c_matrix[(2*i)//tile_height][(2*j)//tile_width]+= 1

				try:
					c_matrix[(2*i)//tile_height][(2*j)//tile_width+1]+= 1
				except IndexError as error:
					error

				try:
					c_matrix[(2*i)//tile_height+1][(2*j)//tile_width]+= 1
				except IndexError as error:
					error
					
				try:
					c_matrix[(2*i)//tile_height+1][(2*j)//tile_width+1]+= 1
				except IndexError as error:			
					error

			j += tile_width//2
			index += 1
			
		i += tile_height//2
	return c_matrix


filelist = []

for filename in glob.glob(os.path.join(path, '*.jpg')):
	filelist.append(filename)

while len(filelist) > 0:
	filename = filelist.pop()
	image = cv2.imread(filename)
	#output = image.copy()

	image_height = image.shape[0]
	image_width = image.shape[1]

	
	r_matrix = crack_matrix(image_height, image_width, 250, 250)

	batches = get_batches(0, 0, image)	
	#print(np.shape(batches))
	#exit()
	prediction = model.predict_on_batch(batches)
	c_matrix = scan_predicts(0, 0, image, prediction)

	i = 0
	while i < len(c_matrix):
		j = 0
		while j < len(c_matrix[i]):
			x = i // 5
			y = j // 5
			r_matrix[x][y] += c_matrix[i][j]
			j += 1
		i += 1


	#print(c_matrix)
	#print(r_matrix)
	i = 0
	my_matrix = []
	while i < len(r_matrix):
		j = 0
		while j < len(r_matrix[i]):
			r = 0
			if r_matrix[i][j] >= 61:
				r = r_matrix[i][j]
			elif r_matrix[i][j] >= 21:
				r = r_matrix[i][j]
			my_matrix.append(r)
			j += 1
		i += 1

	#print(my_matrix)

	out_file = filename + ".json"
	f = open(out_file, 'w')
	json.dump(my_matrix, f)
	f.close()

#lb = pickle.loads(open(args["label_bin"], "rb").read())

# make a prediction on the image
#preds = model.predict(image)

#print(preds)

# find the class label index with the largest corresponding
# probability
#i = preds.argmax(axis=1)[0]
#label = lb.classes_[i]

# draw the class label + probability on the output image
#text = "{}: {:.2f}%".format(label, preds[0][i] * 100)
#cv2.putText(output, "Nut", (10, 30), cv2.FONT_HERSHEY_SIMPLEX, 0.7,
#	(0, 0, 255), 2)

# show the output image
#cv2.imshow("Image", output)
#cv2.waitKey(0)