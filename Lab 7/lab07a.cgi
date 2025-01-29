#!/usr/bin/perl
use CGI':standard';
use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser); 

print header;

print start_html(
	-title => 'Lab07a',
	-style => {
		-type => 'text/css',
        	-code => '
			@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap");

			body {
				font-family: "Roboto", sans-serif;
    	
				text-align: center;    	
				margin-top: 100px;
    				color: #0000FF;
			}

			h1 {
				font-size: 5rem;
			}'
	},
);

print "<h1>This is my first Perl program.</h1>";

print "<p><a href='https://www2.cs.torontomu.ca/~akshaikh/lab07b.html'>Go to Lab07b</a></p>";


print end_html;