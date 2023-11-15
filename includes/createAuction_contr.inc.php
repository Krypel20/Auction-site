<?php
declare(strict_types=1);
//funkcje odpowiedzialne za kontrolę formularza

function create_auction(object $pdo, string $itemName, string $description, string $endDate, string $askingPrice, string $picture)
{
    set_auction($pdo, $itemName, $description, $endDate, $askingPrice, $picture);

}