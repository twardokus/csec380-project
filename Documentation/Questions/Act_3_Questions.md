Link to test here: TODO

We ensure users canot bypass authentication requirements through the use of sessions.

We protect against session fixation by not using cookies

We ensure passwords aren't exposed if that database is stolen by hashing them.

To prevent brute force; TODO

To prevent username enumeration: TODO

If your sessionID is predictable, attackers can use a predicted session token to bypass authentication. To prevent this we use randomly generated php session tokens.