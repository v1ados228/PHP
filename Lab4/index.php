<?php
//1
echo "<h2>Задание 1:</h2>";
$str = 'a1b2c3';
$result = preg_replace_callback('#\d#', function($matches) {
    return $matches[0] . $matches[0];
}, $str);

echo $result;"<br>"
?>

<?php
//2
echo "<h2>Задание 2</h2>";
function isHttpDomain($string) {
    return preg_match('#^https?:\/\/[a-z0-9\-]+(\.[a-z0-9\-]+)*\.[a-z]{2,}\/?$#i', $string);
}

var_dump(isHttpDomain("ftp://site.ru"));
var_dump(isHttpDomain("http://site.ru"));"<br>"

?>

<?php
//3
echo "<h2>Задание 3:</h2>";
function isHttpsDomain($string) {
    return preg_match('#^https?:\/\/[a-z0-9\-]+(\.[a-z0-9\-]+)*\.[a-z]{2,}$#i', $string);
}

var_dump(isHttpDomain("http://site.ru"));
var_dump(isHttpDomain("ftp://site.ru"));"<br>"
?>

<?php
//4
echo "<h2>Задание 4:</h2>";
function isThirdLevelDomain($string) {
    return preg_match('#^[a-z0-9\-]+\.[a-z0-9\-]+\.[a-z]{2,}$#i', $string);
}

var_dump(isThirdLevelDomain("hello.site.ru"));
var_dump(isThirdLevelDomain("example.com"));"<br>"
?>

<?php
//5
echo "<h2>Задание 5:</h2>";
function isValidDomainSimple($string) {
    return preg_match('#^([a-z0-9\-]+\.)+[a-z]{2,}$#i', $string);
}

var_dump(isThirdLevelDomain("hello.site.ru"));
var_dump(isThirdLevelDomain("example..com"));"<br>"
?>