<?php 
    
    function getAuctionById(object $pdo, $id)
    {
        $query = "SELECT * FROM auctions WHERE auctionID = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }