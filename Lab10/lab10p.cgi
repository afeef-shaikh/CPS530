#!/usr/bin/env python

import cgi

# Get the form data
form = cgi.FieldStorage()

# Capture the values
city = form.getvalue('city').upper()
province = form.getvalue('province').upper()
country = form.getvalue('country').upper()
picture_url = form.getvalue('picture')

# Print the HTML response
print("Content-type: text/html\n\n")
print("<html>")
print("<head>")
print("<title>Lab10 - Python Script</title>")
print("<style>")
print("body {font-family: Poppins, sans-serif; background-color: #f4f4f9; text-align: center;}")
print("h1 {color: #4a90e2; background-color: #ffffff; padding: 20px; font-size: 2.5em; border-radius: 8px;}")
print("img {width: 80%; height: auto; border: 10px solid #4a90e2; text-align: center; display: block; margin: 20px auto;}")
print("p {font-size: 1.2em; margin-top: 20px;}")
print("a {text-decoration: none; color: #4a90e2; font-size: 1.2em;}")
print("a:hover {color: #3b8eeb;}")
print("</style>")
print("</head>")
print("<body>")

# Display the formatted city, province, and country
print("<h1>{}, {}, {}</h1>".format(city, province, country))

# Display the city picture if provided
if picture_url:
    print("<img src='{}' alt='City Picture'>".format(picture_url))

# Provide a link back to the form
print("<p><a href='https://www2.cs.torontomu.ca/~akshaikh/Lab10/lab10b.html'>Go Back</a></p>")

print("</body>")
print("</html>")
