# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup
import requests
import time
import os


s = requests.Session()

"""
Log into the application
"""
def login(username, password):
    url = "http://localhost/loginvalidate.php"
    validCreds = {'username': username, 'password': password}
    result = s.post(url, validCreds, allow_redirects=True)
    return result

"""
Test video upload via file
"""
def test_cmdInject():
    login('admin@rit.edu','password')
    url = 'http://localhost/proc/uploader.php'
    params = {'vidtitle':'cmdAttack', 'description' : 'shell_exec ( "mkdir /var/www/html/videos/thisisathing");'}
    f=open('html/videos/testvids/438ad3bf24fed937085ffa101ed06cdb23e30007.mp4','rb')
    result = s.post(url, params, files={'upfile':f})
    urltwo = 'http://localhost/videos.php'
    result = s.post(urltwo)
    assert(os.path.isdir("/var/www/html/videos/thisisathing"))

"""
Utility function to delay test execution until docker-compose has brought all container online.
"""
def wait_for_docker_compose():
    failures = 0
    while failures < 10:
        try:
            home = requests.get("http://localhost", allow_redirects=True)
            break
        except:
            failures += 1
            time.sleep(30)

"""
Test whether the web server is online
"""
def test_connection():
    home = s.get("http://127.0.0.1:80", allow_redirects=True)
    assert (home != None)

"""
Execute test sequence
"""
wait_for_docker_compose()
test_connection()
test_cmdInject
