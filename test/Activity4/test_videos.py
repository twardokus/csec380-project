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
    files = {'upload_file': open('html/videos/testvids/438ad3bf24fed937085ffa101ed06cdb23e30007.mp4','rb')}
    time.sleep(3)
    result = s.post(url, data=params, files=files)
    print(result.text)
    assert('File data uploaded to DB sucessfully.' in result.text)

"""
Test video access
"""
def test_accessvid():
    url = 'http://localhost/videos.php'
    result = s.get(url)

    soup = BeautifulSoup(result.text, 'lxml')
    i=soup.find_all('source')[0]['src'].split('/')[-1]+'\\'
    print(i)
    assert('Uploaded by: admin@rit.edu' in result.text)
    return i

"""
video deletion
"""
def deletevid(i):
    url = 'http://localhost/proc/deletevideo.php'
    params = {'videoHash':i}
    result = s.post(url, params)

    print(result.text)
    assert('File Deleted'in result.text)

"""
Test vid deletion
"""
def test_deletevid():
    i=test_accessvid()
    deletevid(i)

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
test_deletevid()

