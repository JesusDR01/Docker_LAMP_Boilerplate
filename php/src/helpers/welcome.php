<?php
function welcome($conn)
{
    $table = 'users';

    if (tableExist($table, $conn)) {
        displayUsers($conn);
    } else {
        print('<h1>Go to http://localhost:8080</h1>');
        print('<p>User: MYSQL_USER </p>');
        print('<p>password: MYSQL_PASSWORD </p>');
        print('<h2>Open MYSQL_DATABASE => console and paste:</h2>');
        print('<pre>drop table if exists `users`;
        create table `users` (
            id int not null auto_increment,
            username text not null,
            password text not null,
            primary key (id)
        );
        insert into `users` (username, password) values
            ("admin","password"),
            ("Alice","this is my password"),
            ("Job","12345678");</pre>');
    };
}

function tableExist($table, $conn)
{
    if ($result = $conn->query("SHOW TABLES LIKE '" . $table . "'")) {
        if ($result->num_rows == 1) {
            return true;
        }
    } else {
        return false;
    }
};

function displayUsers($conn)
{
    // select query
    $sql = 'SELECT * FROM users';
    //-> is used to call a method, or access a property, on the object of a class
    //=> is used to assign values to the keys of an array
    //$ages = array("Peter"=>32, "Quagmire"=>30, "Joe"=>34, 1=>2); 

    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $users[] = $data;
        }
    }

    //The . is the string concatenation operator.
    foreach ($users as $user) {
        echo "<br>";
        echo $user->username . " " . $user->password;
        echo "<br>";
    };
};