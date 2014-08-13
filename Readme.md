SMART-CHAT
==========

A chat application that provides real-time recommendations when user discusses about movies, restaurants, products, travel etc. on chat. The application works on user click tracking and explicit user feedback to learn preferences and personalize future recommendations and improve classification accuracy.

Authors
--------
Rishi Dua <http://github.com/rishirdua>
Harvineet Singh <https://github.com/harvineet>


Installation
------------

1. Install server
1a. Install tasksel
sudo apt-get install tasksel
1b. Install LAMP Server from tasksel
1c. Copy the files from src/smart-chat to where you want to host (eg: var/www/smart-chat or htdocs/smart-chat/)

2. Install scikit-learn from http://www.lfd.uci.edu/~gohlke/pythonlibs/
2a. Install dependencies:
sudo apt-get install build-essential python-dev python-setuptools \
                     python-numpy python-scipy \
                     libatlas-dev libatlas3gf-base
2b. Download source
2c. Extract source and build with
sudo python setup.py install
(Make sure you have c++ installed)
note: Don't use 3rd party distro as it gives an error

3. Install beautiful soup (http://www.crummy.com/software/BeautifulSoup/#Download)
sudo apt-get install python-bs4

4. Download nltk and nltk data
(NOTE: Use sudo -E if you need user variables eg: proxy settings)
6a. Install settuptools (http://pypi.python.org/pypi/setuptools)
wget https://bootstrap.pypa.io/ez_setup.py
sudo pyhon ez_setup.py
6b. Install Pip: run
sudo easy_install pip
6c. Install NLTK: run
sudo pip install -U nltk
6d. Install wordnet data. Run python and type
import nltk
nltk.download()
Ensure that server is running using root user account and the nltk.data directory is downloaded for that user account

5. Configuration:
5a. config.py (only if you have proxy internet connection on the server end of the application)
5b. config.php (most options are self-explanatory)


Contribute
----------

- Issue Tracker: https://github.com/rishirdua/smart-chat/
- Source Code: github.com/rishirdua/smartchat
- Project page: http://rishirdua.github.io/smart-chat

Support
-------

If you are having issues, contact the authors directly.

License
-------

This projected is licensed under the terms of the MIT license. See LICENCE.txt for details

TODO
------

Prepare installation script
