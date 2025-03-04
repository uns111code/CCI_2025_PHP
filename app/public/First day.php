<!-- <h1>Hello World</h1>

<?php echo 'Hello World'; ?>

<?= "Hello World"; ?> -->


<?php 

    $firstName = "John";  // First Name
    $lastName = "Doe";

    // echo $firstName;
    // echo $firstName . " ". $lastName;  // Outputs: John Doe

    // echo "$firstName $lastName";  // Outputs: John Doe

    // echo '$firstName $lastName';  // Outputs: $firstName $lastName



    // phpinfo();  // Outputs PHP information


    // $val1 = 10;
    // $val2 = 20;

    // $result = $val1 + $val2;

    // echo $result;  // Outputs: 30


    // $val1 = 10;
    // $val2 += 20;

    // echo $val2;  // Outputs: 30


    // $age = 19;

    // if ($age >= 18) {
    //     echo "You are old enough to vote";
    // } else {
    //     echo "You are not old enough to vote";
    // }

?>


<!-- <?php if ($age >= 18): ?>
    <p>You are old enough to vote</p>
<?php else: ?>
    <p>You are not old enough to vote</p>
<?php endif; ?> -->

<?php 

    // $user1 = ['pierre', 'Bertrand', 27, 'pierre@gmail.com'];
    // foreach ($user1 as $info) {
    //     echo "$info<br>";
    // }




    // $user1 = [
    //     'firstName' => 'Pierre',
    //     'lastName' => 'Bertrand',
    //     'age' => 27,
    //     'email' => 'pierre@gmail.com'
    // ];
    //  echo $user1['firstName'];

 //   var_dump($user1);   // debugging tool to display the structure and values of an array


    // foreach ($user1 as $key => $info) {
    //     echo "$key: $info<br>";
    // }


    // if (in_array('Pierre', $user1)) {
    //     echo "Pierre is in the array";
    // } else {
    //     echo "Pierre is not in the array";
    // }


    // $users = [
    //     [
    //         'Name' => 'John Doe',
    //         'age' => 32,
    //         'email' => 'john@test.com',
    //         'active' => true,
    //     ],
    //     [
    //         'Name' => 'Jane Doe',
    //         'age' => 28,
    //         'email' => 'jane@gmail.com',
    //         'active' => false,
    //     ],
    //     [
    //         'Name' => 'Jim Doe',
    //         'age' => 24,
    //         'email' => 'jim@test.com',
    //         'active' => true,
    //     ],
    // ];



?>


<!-- <?php  foreach ($users as $user): ?>
    <div class="card-user">
        <h1 class="card-title"><?= $user['Name'] ?></h1>
        <p class="card-age">
             Age:
             <?= $user['age'] ?></p>
    </div>
<?php endforeach;?> -->



<!-- <?php 


// function bonjour(string $name): void 
// {
//     echo "Hello $name";
// }

// bonjour("Pierre Bertrand"); 

?> -->


<?php

$users = [
    [
        "prenom" => "Pierre",
        "nom" => 'Bertrand',
        "age" => 24,
        "actif" => true,
    ],
    [
        "prenom" => "Paul",
        "nom" => 'Dupont',
        "age" => 33,
        "actif" => true,
    ],
    [
        "prenom" => "Jacques",
        "nom" => 'Dumont',
        "age" => 36,
        "actif" => true,
    ],
    [
        "prenom" => "Thérèse",
        "nom" => 'toto',
        "age" => 45,
        "actif" => false,
    ],
];

function checkUserEnabled(array $user): bool 
{
    return $user['actif'];
};

?>

 <?php foreach ($users as $user):?>
    <?php if (checkUserEnabled($user)):?>
            <h1><?= $user['prenom']; ?></h1>
    <?php endif; ?>
<?php endforeach; ?>




