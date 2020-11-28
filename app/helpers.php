<?php

function getIdFromSlug($slug)
{
    $slugArr = explode('_', $slug);
    return $slugArr[sizeof($slugArr) - 1];
}
