# file to train models on the collected chat data
# uses 5 categories
# Authors:
#   Rishi Dua <http://github.com/rishirdua>
#   Harvineet Singh <https://github.com/harvineet>
#
# This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
# 

import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.feature_selection import SelectKBest, chi2
from sklearn.svm import LinearSVC
from sklearn.naive_bayes import BernoulliNB, MultinomialNB
from nltk.stem.wordnet import WordNetLemmatizer
from sklearn.externals import joblib
import sys

lmtzr = WordNetLemmatizer()

# training classifier
def clfreport(clf,num):

	#read data
	f = open('../data/movie.txt', 'r');
	movDocs = f.readlines();
	y_movDocs = [0]*len(movDocs);
	f = open('../data/product.txt', 'r');
	proDocs = f.readlines();
	y_proDocs = [1]*len(proDocs);
	f = open('../data/restaurant.txt', 'r');
	resDocs = f.readlines();
	y_resDocs = [2]*len(resDocs);
	f = open('../data/car.txt', 'r');
	carDocs = f.readlines();
	y_carDocs = [3]*len(carDocs);
	f = open('../data/hotel.txt', 'r');
	hotDocs = f.readlines();
	y_hotDocs = [4]*len(hotDocs);
	f.close();

	#pre processing: stemming
	stemDocs = lambda sent: [lmtzr.lemmatize(x.decode('utf8')) for x in sent.split()]
	temp = [' '.join(stemDocs(sent)) for sent in movDocs]
	movDocs = temp
	temp = [' '.join(stemDocs(sent)) for sent in proDocs]
	proDocs = temp
	data_train = movDocs + proDocs + resDocs + carDocs + hotDocs

	#TF-IDF
	vectorizer = TfidfVectorizer(sublinear_tf=True, max_df=0.5,stop_words='english')
	X_train = vectorizer.fit_transform(data_train)
	joblib.dump(vectorizer, '../model/model_vec.pkl', compress=9)

	feature_names = np.asarray(vectorizer.get_feature_names())
	categories = [
				'movie',
				'product',
				'restaurant',
				'car',
				'hotel',
				]
	y_train = np.asarray(y_movDocs + y_proDocs + y_resDocs + y_carDocs + y_hotDocs)

	#feature selection
	ch2 = SelectKBest(chi2, k='all')
	X_train = ch2.fit_transform(X_train, y_train)

	#learn model
	clf.fit(X_train, y_train)

	#write model
	joblib.dump(clf, '../model/model'+num+'.pkl', compress=9)

# choose the classifier to train
def trainClf(clf):
	if clf == '1':
		clfreport(MultinomialNB(alpha=.01),clf)
	elif clf == '2':
		clfreport(BernoulliNB(alpha=.01),clf)
	else:
		clfreport(LinearSVC(dual=False, tol=1e-3),clf)
		
# update training data
def updateTraindata(text,label):
	f = open('./data/'+label+'.txt', 'a')
	f.write('\n'+text)
	f.close()
	
if __name__ == "__main__":
	if (len(sys.argv)==2):
		trainClf(sys.argv[1])
	elif (len(sys.argv)==3):
		updateTraindata(sys.argv[1],sys.argv[2])
	else:
		print "Error"

