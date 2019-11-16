Link to test here: \test\test_login.py

We ensure users canot bypass authentication requirements through the use of sessions.

We protect against session fixation by not using cookies.

We ensure passwords aren't exposed if that database is stolen by hashing them.

To prevent brute force we have implemented a reCAPTCHA.

To prevent username enumeration, we do not reveal whether it was the password or the username that was incorrect.

If your sessionID is predictable, attackers can use a predicted session token to bypass authentication. To prevent this we use randomly generated php session tokens.