#!/usr/bin/env python
# -*- coding: utf-8 -*- 

# uses 5 categories
# Authors:
#   Rishi Dua <https://github.com/rishirdua>
#   Harvineet Singh <https://github.com/harvineet>
#
# This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
# 

import sys
sys.path.append('./classify')
from classifymodel import clfToCat
import bs4
import urllib2, urllib, re
from config import http_proxy, https_proxy

# site specific search results from duckduckgo for the text based on it's category

def searchtext(text,site, category):
	try:
		if https_proxy == 'None' and http_proxy == 'None':
			proxy = urllib2.ProxyHandler()
		else:
			proxy = urllib2.ProxyHandler({'https': https_proxy, 'http': http_proxy})
		opener = urllib2.build_opener(proxy)
		urllib2.install_opener(opener)
		
		# headers={'User-agent' : 'Mozilla/5.0'}
		
		query_args = { 'q':text+' site:'+site }
		encoded_args = urllib.urlencode(query_args)
		url = 'http://duckduckgo.com/html/?' + encoded_args
		
		f = urllib2.urlopen(url)
		html = f.read()
		parsed_html = bs4.BeautifulSoup(html)
		searchResuts = parsed_html.findAll('div', {'class': re.compile('links_main*')})
		if len(searchResuts)<2:
			return "no results"
		else:
			topResult = searchResuts[1]
			return ("<a href=\"" + topResult.a['href'] + "\" target=\"_blank\" class=\"recolink\" category=\"" + category + "\">" + topResult.a.text + "</a><br /><p>" + topResult.div.text + "</p>").encode('utf-8')
	except Exception as e:
		return ""
	
# Specify classifier model to use and input sentence to get recommendations from duckduckgo search results for the chat sentence

def textRec(clf, text):
	
	f = open('scores.txt')  # relative scores for the different sites for a chat session
	scoreArray = map(int,f.readlines())
	f.close()

	label = clfToCat(clf, text)
	if label=='movie':
		if(scoreArray[0]>scoreArray[1]):
			link1 = "imdb.com/title"
			site1 = "imdb"
			link2 = "bookmyshow.com"
			site2 =  "bookmyshow"
		else:
			link1 = "bookmyshow.com"
			site1 =  "bookmyshow"
			link2 = "imdb.com/title"
			site2 = "imdb"
	elif label=='product':
		if(scoreArray[2]>scoreArray[3]):
			link1 = "amazon.com"
			site1 = "amazon"
			link2 = "ebay.com"
			site2 = "ebay"
		else:
			link1 = "ebay.com"
			site1 = "ebay"
			link2 = "amazon.com"
			site2 = "amazon"
	elif label == 'restaurant':
		if(scoreArray[4]>scoreArray[5]):
			link1 = "yelp.com/biz"
			site1 = "yelp"
			link2 = "zomato.com"
			site2 = "zomato"
		else:
			link1 = "zomato.com"
			site1 = "zomato"
			link2 = "yelp.com/biz"
			site2 = "yelp"
	elif label == 'car':
		if(scoreArray[6]>scoreArray[7]):
			link1 = "edmunds.com"
			site1 = "edmunds"
			link2 = "car.com"
			site2 = "car"
		else:
			link1 = "car.com"
			site1 = "car"
			link2 = "edmunds.com"
			site2 = "edmunds"
	elif label == 'hotel':
		if(scoreArray[8]>scoreArray[9]):
			link1 = "tripadvisor.com"
			site1 = "tripadvisor"
			link2 = "hotels.com"
			site2 = "hotels"
		else:
			link1 = "hotels.com"
			site1 = "hotels"
			link2 = "tripadvisor.com"
			site2 = "tripadvisor"
	
	reco1 = searchtext(text, link1, site1)
	reco2 = searchtext(text, link2, site2)
	if (reco1!="no results") and (reco2!="no results"):
		print label + "\t" + searchtext(text, link1, site1) + searchtext(text, link2, site2)+ "<div id=\"currenttext\" style=\"visibility:hiddens\" label=\"" +label + "\">" + text + "</div>"

if __name__ == "__main__":
	if (len(sys.argv)>2):
		text = sys.argv[2]
		textRec(sys.argv[1], text)
	elif (len(sys.argv)==2):
		text = sys.argv[1]
		textRec('3', text)
	else:
		print "Uncaught Error. Notify admin"