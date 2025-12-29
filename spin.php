<?php
session_start();

/* fake user */
$_SESSION['points'] = $_SESSION['points'] ?? 12;

/* rewards from admin */
$rewards = [
    ["name" => "Premium 3 days", "chance" => 25],
    ["name" => "+50 Gold", "chance" => 20],
    ["name" => "VIP Icon", "chance" => 15],
    ["name" => "Nickname Color", "chance" => 10],
    ["name" => "Avatar NY", "chance" => 8],
    ["name" => "JACKPOT", "chance" => 1]
];

if ($_SESSION['points'] < 3) {
    echo json_encode(["error" => "Not enough points"]);
    exit;
}

$_SESSION['points'] -= 3;

$rand = rand(1, 100);
$current = 0;

foreach ($rewards as $r) {
    $current += $r['chance'];
    if ($rand <= $current) {
        echo json_encode([
            "reward" => $r['name'],
            "points" => $_SESSION['points']
        ]);
        exit;
    }
}
