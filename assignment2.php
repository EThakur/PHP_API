<?php

// Database connection settings
$hostname = "localhost"; 
$username = "web"; 
$password = "web"; 
$database = "webshop"; 
 


/////same
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new user
function addUser($email, $password, $username, $purchaseHistory, $shippingAddress) {
    global $conn;
    $sql = "INSERT INTO User (email, password, username, purchase_history, shipping_address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $email, $password, $username, $purchaseHistory, $shippingAddress);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to get user details by ID
function getUser($id) {
    global $conn;
    $sql = "SELECT * FROM User WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to update user details
function updateUser($id, $email, $password, $username, $purchaseHistory, $shippingAddress) {
    global $conn;
    $sql = "UPDATE User SET email = ?, password = ?, username = ?, purchase_history = ?, shipping_address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $email, $password, $username, $purchaseHistory, $shippingAddress, $id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a user
function deleteUser($id) {
    global $conn;
    $sql = "DELETE FROM User WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Usage examples:

// Add a new user
// addUser("user@example.com", "password123", "username", "[]", "123 Example St, City");

// Get user details
// $user = getUser(1);
// print_r($user);

// Update user details
// updateUser(1, "newemail@example.com", "newpassword", "newusername", "[{\"product\":1,\"quantity\":2}]", "456 New St, Town");

// Delete user
// deleteUser(1);

// Close database connection
$conn->close();

?>
