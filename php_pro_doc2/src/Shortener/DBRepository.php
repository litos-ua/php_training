<?php

namespace Doctor\PhpPro\Shortener;

use Doctor\PhpPro\ORM\ActiveRecord\Models\UrlCode;
use Doctor\PhpPro\Shortener\Exceptions\DataNotFoundException;
use Doctor\PhpPro\Shortener\ValueObjects\UrlCodePair;

class DBRepository implements Interfaces\ICodeRepository
{

    /**
     * @inheritDoc
     */
    public function saveEntity(UrlCodePair $urlUrlCodePair): bool
    {
        $urlCode = new UrlCode();
        $urlCode->code = $urlUrlCodePair->getCode();
        $urlCode->url = $urlUrlCodePair->getUrl();

        return $urlCode->save();
    }

    /**
     * @inheritDoc
     */
    public function codeIsset(string $code): bool
    {
        return (bool)UrlCode::query()
            ->where('code', '=', $code)
            ->count();;
    }

    /**
     * @inheritDoc
     */
    public function getUrlByCode(string $code): string
    {
        $res = UrlCode::query()
            ->where('code', '=', $code)
            ->first();
        if (is_null($res)) {
            throw new DataNotFoundException('Url by code "' . $code . '" not found');
        }
        return $res->url;
    }

    /**
     * @inheritDoc
     */
    public function getCodeByUrl(string $url): string
    {
        $res = UrlCode::query()
            ->where('url', '=', $url)
            ->first();
        if (is_null($res)) {
            throw new DataNotFoundException('Code by url "' . $url . '" not found');
        }
        return $res->code;
    }
}
