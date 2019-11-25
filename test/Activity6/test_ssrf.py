# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup
import requests
import time

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
def test_uploadvid():
    login('admin@rit.edu','password')
    url = 'http://localhost/proc/uploader.php'
    params = {'vidtitle':'catz'}
    f=open('html/videos/testvids/438ad3bf24fed937085ffa101ed06cdb23e30007.mp4','rb')
    result = s.post(url, params, files={'upfile':f})

    assert('File data uploaded to DB sucessfully.' in result.text)

def uploadvid():
    url = 'http://localhost/proc/uploader.php'
    titles = ['red fish', 'blue fish', 'Epstein didnt kill himself']
    
    for t in titles:
        params = {'vidtitle':t}
        f=open('html/videos/testvids/438ad3bf24fed937085ffa101ed06cdb23e30007.mp4','rb')
        result = s.post(url, params, files={'upfile':f})

        assert('File data uploaded to DB sucessfully.' in result.text)

def logout():
    url = 'http://localhost/logout.php'
    result = s.get(url)

def test_ssrf():
    url = 'http://localhost/proc/uploader.php'
    params = {'vidtitle':'hacky','downloadurl':'file:///etc/passwd'}
    result = s.post(url, params)
    result = s.get('http://localhost/videos.php')
    assert('hacky' in result.text and 'videos/1/passwd' in result.text)


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
test_uploadvid()
test_ssrf()
