<?php
include "database.php";

function registerUser($firstName, $lastName, $login, $password) {
    $connection = connectBDD();
    $firstName = htmlspecialchars($firstName);
    $lastName = htmlspecialchars($lastName);
    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);
    $password = hash("sha512", $password);

    $query = $connection->prepare("INSERT INTO USERS (`name_users`, `last_name_users`, `role_users`, `login_users`, `password_users`) 
                                   VALUES (:firstName,:lastName,'user',:login,:password)");
    $query->bindValue(":firstName", $firstName, PDO::PARAM_STR);
    $query->bindValue(":lastName", $lastName, PDO::PARAM_STR);
    $query->bindValue(":login", $login, PDO::PARAM_STR);
    $query->bindValue(":password", $password, PDO::PARAM_STR);
    $query->execute();
}

function login($login, $password) {
    $connection = connectBDD();
    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);
    $password = hash("sha512", $password);

    $query = $connection->prepare("SELECT * FROM USERS
                                   WHERE USERS.login_users = :login
                                   AND USERS.password_users = :password");
    $query->bindValue(":login", $login, PDO::PARAM_STR);
    $query->bindValue(":password", $password, PDO::PARAM_STR);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);

    if ($data == false) {
        return false;
    }
    else {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION["name_users"] = $data["name_users"];
        $_SESSION["last_name_users"] = $data["last_name_users"];
        $_SESSION["role_users"] = $data["role_users"];
        $_SESSION["login_users"] = $data["login_users"];
        $_SESSION["password_users"] = $data["password_users"];
        $_SESSION["id_users"] = $data["id_users"];
        $_SESSION["addresses_users"] = getUserAddresses($data["id_users"]);
        return true;
    }
}

function logout() {
    if (!isset($_SESSION)) {
        session_start();
    }
    session_unset();
    session_destroy();
}

function isLogged() {
    if (!isset($_SESSION)) {
        session_start();
    }
    $logged = false;
    if (isset($_SESSION["login_users"])) {
        $user = getUserByMail($_SESSION["login_users"]);
        if ($user["login_users"] == $_SESSION["login_users"] && $user["password_users"] == $_SESSION["password_users"]) {
            $logged = true;
        }
    }
    return $logged;
}

function getUserByMail($login) {
    $connection = connectBDD();
    $login = htmlspecialchars($login);

    $query = $connection->prepare("SELECT * FROM USERS
                                   LEFT JOIN ADDRESS ON USERS.id_users = ADDRESS.id_users
                                   WHERE USERS.login_users = :login");
    $query->bindValue(":login", $login, PDO::PARAM_STR);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function updateNameUser($login, $name) {
    $connection = connectBDD();
    $name = htmlspecialchars($name);

    $query = $connection->prepare("UPDATE USERS SET name_users = :name WHERE login_users = :login");
    $query->bindValue(":name", $name, PDO::PARAM_STR);
    $query->bindValue(":login", $login, PDO::PARAM_STR);
    $query->execute();
}

function updateLastNameUser($login, $lastName) {
    $connection = connectBDD();
    $lastName = htmlspecialchars($lastName);

    $query = $connection->prepare("UPDATE USERS SET last_name_users = :lastName WHERE login_users = :login");
    $query->bindValue(":lastName", $lastName, PDO::PARAM_STR);
    $query->bindValue(":login", $login, PDO::PARAM_STR);
    $query->execute();
}

function updateLoginUser($oldLogin, $newLogin) {
    $connection = connectBDD();
    $newLogin = htmlspecialchars($newLogin);

    $query = $connection->prepare("UPDATE USERS SET login_users = :newLogin WHERE login_users = :oldLogin");
    $query->bindValue(":newLogin", $newLogin, PDO::PARAM_STR);
    $query->bindValue(":oldLogin", $oldLogin, PDO::PARAM_STR);
    $query->execute();
}

function updatePasswordUser($login, $password) {
    $connection = connectBDD();
    $password = htmlspecialchars($password);
    $password = hash("sha512", $password);

    $query = $connection->prepare("UPDATE USERS SET password_users = :password WHERE login_users = :login");
    $query->bindValue(":password", $password, PDO::PARAM_STR);
    $query->bindValue(":login", $login, PDO::PARAM_STR);
    $query->execute();
}

function getUserAddresses($userId) {
    $connection = connectBDD();

    $query = $connection->prepare("SELECT * FROM ADDRESS WHERE id_users = :userId");
    $query->bindValue(":userId", $userId, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function addAddress($userId, $streetNb, $street, $postalCode, $city, $country) {
    $connection = connectBDD();
    $streetNb = htmlspecialchars($streetNb);
    $street = htmlspecialchars($street);
    $postalCode = htmlspecialchars($postalCode);
    $city = htmlspecialchars($city);
    $country = htmlspecialchars($country);

    $query = $connection->prepare("INSERT INTO ADDRESS (id_users, street_nb_address, street_address, postal_code_address, city_address, country_address)
                                   VALUES (:userId, :streetNb, :street, :postalCode, :city, :country)");
    $query->bindValue(":userId", $userId, PDO::PARAM_INT);
    $query->bindValue(":streetNb", $streetNb, PDO::PARAM_STR);
    $query->bindValue(":street", $street, PDO::PARAM_STR);
    $query->bindValue(":postalCode", $postalCode, PDO::PARAM_STR);
    $query->bindValue(":city", $city, PDO::PARAM_STR);
    $query->bindValue(":country", $country, PDO::PARAM_STR);
    $query->execute();
}

function updateAddress($addressId, $streetNb, $street, $postalCode, $city, $country) {
    $connection = connectBDD();
    $streetNb = htmlspecialchars($streetNb);
    $street = htmlspecialchars($street);
    $postalCode = htmlspecialchars($postalCode);
    $city = htmlspecialchars($city);
    $country = htmlspecialchars($country);

    $query = $connection->prepare("UPDATE ADDRESS SET street_nb_address = :streetNb, street_address = :street, postal_code_address = :postalCode, city_address = :city, country_address = :country 
                                    WHERE id_address = :addressId");
    $query->bindValue(":addressId", $addressId, PDO::PARAM_INT);
    $query->bindValue(":streetNb", $streetNb, PDO::PARAM_STR);
    $query->bindValue(":street", $street, PDO::PARAM_STR);
    $query->bindValue(":postalCode", $postalCode, PDO::PARAM_STR);
    $query->bindValue(":city", $city, PDO::PARAM_STR);
    $query->bindValue(":country", $country, PDO::PARAM_STR);
    $query->execute();
}

function deleteAddress($addressId) {
    $connection = connectBDD();

    $query = $connection->prepare("DELETE FROM ADDRESS WHERE id_address = :addressId");
    $query->bindValue(":addressId", $addressId, PDO::PARAM_INT);
    $query->execute();
}
?>