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
def test_cmdInject():
    login('admin@rit.edu','password')
    url = 'http://localhost/proc/uploader.php'
    params = {'vidtitle':'cmdAttack', 'description' : 'shell_exec ( "mkdir /var/www/html/videos/thisisathing");'}
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

"""
Classic SQLi test
"""
def test_classicsqli():
    uploadvid()
    url = 'http://localhost/videos.php'
    #params = {'title':"test' or 1=1;--"}
    params = {'title':"test"}
    result = s.post(url,params)

    #print(result.text)
    assert('Epstein didnt kill himself' in result.text)

def logout():
    url = 'http://localhost/logout.php'
    result = s.get(url)

"""
Blind SQLi test
"""
def test_blindsqli():
    logout() 
    r = login("admin@rit.edu' and 1 = 2 LIMIT 1 --']","badpass")
    assert('Error' in r.text)
    logout()
    r = login("admin@rit.edu' and 1 = 1 LIMIT 1 --']","badpass")
    assert('Bad credentials' not in r.text)


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
test_classicsqli()
test_blindsqli()
