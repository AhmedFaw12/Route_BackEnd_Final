<?php

/*
-The readfile("file_name or path") function: reads a file and writes it to the output buffer(prints the whole file).

-To read part by part:
1)fopen(filename, mode):opens a file or URL.
 
-parameters:
    mode:
    - "r" :Read only
    - "w" : Write only. Opens and truncates the file(overwrite); or creates a new file if it doesn't exist

    -"a" : Write only. Opens and writes to the end of the file or creates a new file if it doesn't exist

-return:
    A file pointer resource on success, FALSE and an error on failure.

2)fread(filepointer, length) :
    -The fread() reads from an open file.
    -The function will stop at the end of the file or when it reaches the specified length, whichever comes first.

    parameter:
    filepointer : Required. Specifies the open file to read from
    -length	: Required. Specifies the maximum number of bytes to read
         -every latin character takes 1 byte

3)filesize(filename):returns the size of a file.         

4)rewind(filepointer) :"rewinds"(بترجع) the position of the file pointer to the beginning of the file.


5)fgets($file) : returns a line from an open file.(get single line)

    return :A single line read from the file on success,FALSE on EOF(end of file) or error

6)fgetc($file) :returns a single character from an open file.
    
-This function is slow and should not be used on large files. If you need to read one character at a time from a large file, use fgets() to read data one line at a time and then process the line one single character at a time with fgetc().


7)fclose(filepointer): closes an open file pointer.
            the file must have been opened by fopen()


8)file_exists(path to the file) :checks whether a file or directory exists.
    -return : TRUE if the file or directory exists, FALSE on failure
//////////////////////////////////////////////////////////////

Notes on reading or writing into files:

-all files that we can read are (.txt) files not formated files like (excel, word, pdf ,....)

-To read formated files, we must search for php libraries to read formated files

-To read excel sheets without libraries , we can use (.csv)

-csv(comma delimited) files:
    - it is called comma delimited(separated) because it seperates between columns by comma(,)

    - csv files are text files but seperates between columns by comma(,)

    -I can make csv by excel then save file as (.csv)

    - it is easy to read without any external libraries

*/

//example on readfile
readfile("data.txt");
echo "<hr>";


//example on partially reading file   
$file = fopen("data.txt", "r");
echo fread($file, 10), "<br>";
echo fread($file, 10), "<br>";
echo fread($file, 10), "<br>";
echo fread($file, 10), "<br>";


echo "<hr>";
//example on filesize():
rewind($file); // returning pointer to the beginning of the file.
echo fread($file, filesize("data.txt") / 2), "<br>"; //read half of file
echo fread($file, filesize("data.txt") / 2), "<br>"; //read half of file

echo "<hr>";


//example on fgets()
rewind($file); // returning pointer to the beginning of the file.

while ($line = fgets($file)) {
    echo $line, "<br>";
}
echo "<hr>";

//example on fgets()
rewind($file); // returning pointer to the beginning of the file.


while ($c = fgetc($file)) {
    echo $c, " ";
}
echo "<hr>";
fclose($file);

//example 
$file = fopen("data.csv", "r");
while ($line = fgets($file)) {
    // echo $line, "<br>";  

    //printing every word in the line
    $data = explode(",", $line); //returns array
    foreach ($data as $d) {
        echo $d, " ";
    }
    echo "<br>";
}

echo "<hr>";
fclose($file);

?>

<!-- ----------------example on reading------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>name</th>
                <th>salary</th>
                <th>job</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $file = fopen("data.csv", "r");
            while ($line = fgets($file)) {
                // echo $line, "<br>";  
           
                echo "<tr>";
                //printing every word in the line
                $data = explode(",", $line); //returns array
                foreach ($data as $d) {
                    echo "<td>$d</td>";
                }
                echo "</tr>";
            }

            fclose($file);
            ?>

        </tbody>

    </table>
</body>

</html>