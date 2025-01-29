#!/usr/bin/perl
use CGI ':standard';
use strict;
use warnings;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);
use File::Basename;

# Define paths for script and upload directory
my $script_path = '/class-service/akshaikh/public_html/cgi-bin';
my $upload_dir = "$script_path/uploads";

mkdir $upload_dir or die "Cannot create $upload_dir: $!" unless -d $upload_dir;

my $query = CGI->new;

# Retrieve form datax
my $firstName = $query->param('First Name');
my $lastName = $query->param('Last Name');
my $streetName = $query->param('Street Name');
my $city = $query->param('City');
my $postalCode = $query->param('Postal Code');
my $province = $query->param('Province');
my $phoneNumber = $query->param('Phone Number');
my $email = $query->param('Email');
my $photo = $query->param('Photo');

$photo =~ s/.*[\/\\](.*)/$1/;
my $upload_filehandle = $query->upload('Photo');

# Upload the photo to the server
if ($upload_filehandle) {
    open my $UPLOADFILE, ">", "$upload_dir/$photo" or die "Cannot open file $upload_dir/$photo: $!";
    while (<$upload_filehandle>) {
        print $UPLOADFILE;
    }
    close $UPLOADFILE;
}

# Validation using regex
my $validPhoneNumber = $phoneNumber =~ /^\d{10}$/;
my $validPostalCode = $postalCode =~ /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/;
my $validEmail = $email =~ /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
my $validPhoto = $photo =~ /\.(jpg|jpeg|gif|png)$/i;

# HTML output with updated CSS
print header;
print start_html(
    -title => 'Lab07b Result',
    -style => {
        -type => 'text/css',
        -code => '
            @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap");

            body {
                font-family: "Roboto", sans-serif;
                background-color: #e8f0fe;
                text-align: center;
            }

            div.container {
                max-width: 700px;
                margin: 40px auto;
                padding: 30px;
                background-color: #f4f8fb;
                border-radius: 16px; /* Larger rounded corners */
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                text-align: left;
            }

            h2 {
                text-align: center;
                color: #1e70bf;
                font-size: 1.8rem;
            }

            ul {
                list-style-type: none;
                padding: 0;
            }

            li {
                margin-bottom: 12px;
                font-size: 1rem;
                color: #333;
            }

            .error {
                color: #ff0000;
                font-weight: bold;
                display: inline-block;
                margin-left: 5px;
            }

            img {
                max-width: 100%;
                height: auto;
                margin-top: 10px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            }

            p a {
                color: #1e70bf;
                text-decoration: none;
            }

            p a:hover {
                text-decoration: underline;
            }
        ',
    },
);

print "<div class='container'>";
print "<h2>Form Submission Result</h2>";

print "<ul>";
print "<li><strong>First Name:</strong> $firstName</li>";
print "<li><strong>Last Name:</strong> $lastName</li>";
print "<li><strong>Street Name:</strong> $streetName</li>";
print "<li><strong>City:</strong> $city</li>";

# Postal Code validation
print "<li><strong>Postal Code:</strong> ";
print $validPostalCode ? $postalCode : "<span class='error'>Invalid format. Correct = L9X 8J0</span>";
print "</li>";

print "<li><strong>Province:</strong> $province</li>";

# Phone Number validation
print "<li><strong>Phone Number:</strong> ";
print $validPhoneNumber ? $phoneNumber : "<span class='error'>Invalid format. Correct = 4165789456</span>";
print "</li>";

# Email validation
print "<li><strong>Email Address:</strong> ";
print $validEmail ? $email : "<span class='error'>Invalid format. Correct = example\@domain.com</span>";
print "</li>";

# Photo validation
print "<li><strong>Photograph:</strong> ";
if ($validPhoto) {
    print "<img src='uploads/$photo' alt='User Photo'>";
} else {
    print "<span class='error'>Invalid file format. Only jpg, jpeg, gif, png allowed.</span>";
}
print "</li>";

print "</ul>";
print "<p><a href='../lab07b.html'>Go Back</a></p>";
print "</div>";

print end_html;
