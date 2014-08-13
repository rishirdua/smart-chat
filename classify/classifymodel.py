# file to classify given chat sentence using the trained model
# uses 5 categories
# Authors:
#   Rishi Dua <http://github.com/rishirdua>
#   Harvineet Singh <https://github.com/harvineet>
#
# This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
# 
# sample usage:
#
# sentence = "amazon's deal on this device is very expensive"
# clfreport('./models/model1.pkl',sentence)
# model1.pkl: Multinomial, model2.pkl:Bernoulli, model3.pkl: Linear SVM

import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.feature_selection import SelectKBest, chi2
from sklearn.svm import LinearSVC
from sklearn.naive_bayes import BernoulliNB, MultinomialNB
from nltk.stem.wordnet import WordNetLemmatizer
from sklearn.externals import joblib
lmtzr = WordNetLemmatizer()

#classify a given sentence into a cateogory
def clfreport(model,sentence):

	#stemming
	stemDocs = lambda sent: [lmtzr.lemmatize(x) for x in sent.split()]
	categories = [
				'movie',
				'product',
				'restaurant',
				'car',
				'hotel',
				]
	#load TF_IDF vectors
	vectorizer = joblib.load('./models/model_vec.pkl')
	clf = joblib.load(model)
	temp = [' '.join(stemDocs(sentence))]
	test_sent = vectorizer.transform(temp)
	label = clf.predict(test_sent)
	return [j for (i,j) in enumerate(categories) if i==label]
			
def clfToCat(clf, sentence):
	return clfreport('./models/model'+clf+'.pkl',sentence)[0]
	


