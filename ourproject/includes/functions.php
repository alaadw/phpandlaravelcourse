<?php
function getDateDifference($createdAt) {
        $now = new DateTime();
        $createdAt = new DateTime($createdAt);
        $interval = $now->diff($createdAt);
        return $interval->format('%a days ago');
    }