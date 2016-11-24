#!/bin/bash

echo "Script removes folder '../phpmd' and creates it new with the outcome of testing."

echo "START"

rm -rf ../phpmd
mkdir ../phpmd

declare -a tests=("cleancode" "codesize" "controversial" "design" "naming" "unusedcode")

for test in "${tests[@]}";
do
    php vendor/bin/phpmd src/ html $test > ../phpmd/$test.html
    echo "create $test.html"
    echo "<a href='$test.html'>$test</a><br/>" >> ../phpmd/index.html
done

echo "END"
