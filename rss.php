<?php echo '<?xml version="1.0" encoding="windows-1251" ?>'; ?>
<rss version="2.0">
<?php
include("config.php");
    function rssDate($timestamp){
        $timestamp = strtotime($timestamp);
        return date(DATE_RSS, $timestamp);
    }
?>
<channel>
<title>���-���� �������� � �������</title>
<language>bg</language>
<description>���������� �������� �������� � ������ ������� �� �������</description>
<link>http://borsa.vkonov.info</link>
<copyright></copyright>

<?php
$query = mysql_query("SELECT `books`.`id`, `genres`.`genre_name`, `books`.`specifics`, `books`.`class`, `books`.`authors`,`publisher`.`name`, `books`.`date`
                      FROM `books` 
                      JOIN `genres` ON `genres`.`id`=`books`.`genre_id`
                      JOIN `publisher` ON `publisher`.`id`=`books`.`publisher_id`
                      ORDER BY id DESC");
while($row = mysql_fetch_assoc($query)){
?>
     <item>
        <title>������� �� <?php echo $row['genre_name']; ?></title>
        <description>
        <![CDATA[<font size="3">]]>
            ����������: <?php echo $row['specifics']; ?><![CDATA[<br>]]>
            ����: <?php echo $row['class']; ?><![CDATA[<br>]]>
            ������: <?php echo $row['authors']; ?><![CDATA[<br>]]>
            �����������: <?php echo $row['name']; ?>
        <![CDATA[</font>]]>
        </description>
        <link>http://localhost/borsa/index.php?pages=book_info&amp;book_id=<?php echo $row['id']; ?></link>
        <pubDate><?php echo rssDate($row['date']); ?></pubDate>
     </item>  
<?php } ?>  

</channel>
</rss>