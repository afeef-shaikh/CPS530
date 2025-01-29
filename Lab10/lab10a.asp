<%
Function IsValidColor(color)
    Dim regex
    Set regex = New RegExp
    regex.Pattern = "^[a-zA-Z]+$"
    IsValidColor = regex.Test(color)
End Function

Dim bgColor
bgColor = Request.QueryString("color")

If bgColor = "" Or Not IsValidColor(bgColor) Then
    bgColor = "lightblue"
End If

' Add 1 hour to the current time
Dim adjustedTime
adjustedTime = DateAdd("h", 1, Now())

Response.Write "<html>"
Response.Write "<body style='background-color: " & bgColor & "; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; font-family: Poppins, sans-serif;'>"

If Request.Cookies("lastVisit") = "" Then
    Response.Write "<p style='font-size: 1.5rem; font-weight: bold;'>Welcome! This is your first visit.</p>"
Else
    Response.Write "<p style='font-size: 1.5rem; font-weight: bold;'>Your last visit was on: " & Request.Cookies("lastVisit") & "</p>"
End If

Response.Cookies("lastVisit") = adjustedTime

Response.Write "<div style='font-size: 1.5rem; font-weight: bold; margin-bottom: 10px;'>Choose a color:</div>"

Response.Write "<div style='display: flex; gap: 15px;'>"
Response.Write "<a href='?color=gray' style='text-decoration: none;'>Gray</a> | "
Response.Write "<a href='?color=green' style='text-decoration: none;'>Green</a> | "
Response.Write "<a href='?color=blue' style='text-decoration: none;'>Blue</a> | "
Response.Write "<a href='?color=red' style='text-decoration: none;'>Red</a> | "
Response.Write "<a href='?color=yellow' style='text-decoration: none;'>Yellow</a> | "
Response.Write "<a href='?color=white' style='text-decoration: none;'>White</a>"
Response.Write "</div>"

Response.Write "<a href='https://www.cs.torontomu.ca/~akshaikh/Lab10/lab10.html' style='margin-top: 50px; font-size: 1rem;'>Back to Lab10.html</a>"

Response.Write "</body></html>"
%>
