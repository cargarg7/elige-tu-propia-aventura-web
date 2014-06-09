# Choose Your Own Adventure

**Choose Your Own Adventure** is a series of children's gamebooks where each story is written
from a second-person point of view, with the reader assuming the role of the protagonist and
making choices that determine the main character's actions and the plot's outcome. The series
was based on a concept created by Edward Packard and originally published by Constance Cappel's
and R. A. Montgomery's Vermont Crossroads Press as the "Adventures of You" series, starting with
Packard's Sugarcane Island in 1976.

**Choose Your Own Adventure**, as published by Bantam Books, was one of the most popular children's
series during the 1980s and 1990s, selling more than 250 million copies between 1979 and 1998.
When Bantam, now owned by Random House, allowed the Choose Your Own Adventure trademark to lapse,
the series was relaunched by Chooseco, which now owns the CYOA trademark. Notably, Chooseco does
not reissue titles by Packard, who has started his own imprint, U-Ventures.

## Requirements
    PHP
    MySQL
    node

## Set up PHP dependencies
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install

## Set up JS dependencies
    bower install

## Set up database schema
    php bin/doctrine orm:database-schema:create

## Start the server
    php -S localhost:8080 -t app/silex
