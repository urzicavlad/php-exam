<?php
include "config.php";
session_start();
$sessionIsSet = false;
if (isset($_SESSION['user_id'])) {
    $sessionIsSet = true;
    $orderBy = $_SESSION['orderBy'];
}

$noOpQuery = "SELECT * FROM users";
$defaultQuery = "SELECT * FROM users ORDER BY USERNAME ";


$getAllUsers = isset($orderBy) ? $defaultQuery . $orderBy : $noOpQuery;

$result = $connection->query($getAllUsers);
$rows = null;

while ($row = $result->fetch_array()) {
    $rows[] = $row;
}
$HEADER_TEMPLATE = "<th class=\"cell100 column1\">%s</th>";
$ROW_TEMPLATE = "<td class=\"cell100 column1\">%s</td>";

//HEADER
printf("<div class=\"table100-head\">");
printf("<table>");
printf("<thead>");
printf("<tr class=\"row100 head\">");
printf($HEADER_TEMPLATE, 'Username');
if ($sessionIsSet) {
    printf($HEADER_TEMPLATE, 'Id');
    printf($HEADER_TEMPLATE, 'Firstname');
    printf($HEADER_TEMPLATE, 'Lastname');
    printf($HEADER_TEMPLATE, 'Email');
    printf($HEADER_TEMPLATE, 'Sex');
    printf($HEADER_TEMPLATE, 'Marital-Status');
    printf($HEADER_TEMPLATE, 'Profile-Photo');
    printf($HEADER_TEMPLATE, 'Register-Date');
}
printf("</tr>");
printf("</thead>");
printf("</table>");
printf("</div>");

//BODY
printf("<div class=\"table100-body js-pscroll\">");
printf("<table>");
printf("<tbody>");
foreach ($rows as $row) {
    printf("<tr>");
    printf($ROW_TEMPLATE, $row['username']);
    if ($sessionIsSet) {
        printf($ROW_TEMPLATE, $row['id']);
        printf($ROW_TEMPLATE, $row['lastname']);
        printf($ROW_TEMPLATE, $row['firstname']);
        printf($ROW_TEMPLATE, $row['email']);
        printf($ROW_TEMPLATE, $row['sex']);
        printf($ROW_TEMPLATE, $row['maritalstatus']);
        printf($ROW_TEMPLATE, pathinfo($row['profilephoto'], PATHINFO_BASENAME));
        printf($ROW_TEMPLATE, $row['registerDate']);
    }
    printf("</tr>");
}
printf("</tbody>");
printf("</table>");
printf("</div>");

//BUTTONS
if ($sessionIsSet) {
    printf('<button class="btn btn-danger" onclick="window.location.href=\'logout.php\'">Log out</a></button>');
    printf('<button class="btn btn-primary" 
                    onclick="window.location.href=\'changePassword.html\'">Change password</button>');
}
