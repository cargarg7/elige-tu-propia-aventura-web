<?php

namespace Etpa\Infrastructure\Persistence\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Etpa\Domain\StoryId;

class StoryIdType extends Type
{
    const STORY_ID = 'storyid';

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'StoryId';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new StoryId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->id();
    }

    public function getName()
    {
        return self::STORY_ID;
    }
}
