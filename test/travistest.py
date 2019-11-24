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
    url = 'http://localhost/phpinfo.php'
    result = requests.post(url)
    print(result.text)
    urltwo = 'http://localhost/travistest.php'
    resulttwo = requests.post(urltwo)
    print(resulttwo.text)

"""
Test video access
"""
def test_accessvid():
    url = 'http://localhost/videos.php'
    result = s.get(url)

    soup = BeautifulSoup(result.text, 'lxml')
    src=soup.find_all('source')[0]['src'].split('/')[-1]+'\\'
    print(src)
    assert('Uploaded by: admin@rit.edu' in result.text)
    return src

"""
Test video deletion
"""
def test_deletevid(src):
    url = 'http://localhost/proc/deletevideo.php'
    params = {'videoHash':src}
    result = s.post(url, params)

    print(result.text)
    assert('File Deleted'in result.text)


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
