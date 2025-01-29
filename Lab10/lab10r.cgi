#!/usr/bin/ruby -w

require 'cgi'
cgi = CGI.new

# Get the form data
city = cgi['city'].capitalize
province = cgi['province'].capitalize
country = cgi['country'].capitalize
picture_url = cgi['picture']

# Print the HTML response
puts "Content-type: text/html\n\n"
puts "<html>"
puts "<head>"
puts "<title>Lab10 Ruby Script</title>"
puts "<style>"
puts "body {font-family: Poppins, sans-serif; background-color: #f4f4f9; text-align: center;}"
puts "h1 {color: #4a90e2; background-color: #ffffff; padding: 20px; font-size: 2.5em; border-radius: 8px;}"
puts "img {width: 100%; height: auto; border: 10px solid #4a90e2; text-align: center; display: block; margin: 20px auto;}"
puts "p {font-size: 1.2em; margin-top: 20px;}"
puts "a {text-decoration: none; color: #4a90e2; font-size: 1.2em;}"
puts "a:hover {color: #3b8eeb;}"
puts "</style>"
puts "</head>"
puts "<body>"

# Display the formatted city, province, and country
puts "<h1>#{city}, #{province}, #{country}</h1>"

# Display the city picture if provided
if picture_url
    puts "<img src='#{picture_url}' alt='City Picture'>"
end

# Provide a link back to the form
puts "<p><a href='https://www2.cs.torontomu.ca/~akshaikh/Lab10/lab10b.html'>Go Back</a></p>"

puts "</body>"
puts "</html>"