<<<<<<< HEAD
---
title: "PHPStan: FFMpeg Export save()"
module: "Media"
type: concept
tags: [phpstan, ffmpeg, export]
created: 2026-07-14
updated: 2026-07-15
qmd: "phpstan ffmpeg export save mediaexporter addfilter chain"
issues:
  - "https://github.com/laraxot/base_ptvx_fila5/issues/711"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/1"
related:
  - "./wiki/troubleshooting/phpstan-fixes.md"
  - "./actions/convert-video-by-media-convert.md"
---

=======
>>>>>>> f6dc2a0 (.)
# PHPStan: FFMpeg Export save()

## Contesto

<<<<<<< HEAD
`ConvertVideoByConvertDataAction` e `ConvertVideoByMediaConvertAction` usano `ProtoneMedia\LaravelFFMpeg`. PHPStan segnala `PHPFFMpeg::save()` undefined quando `addFilter()` è concatenato nella fluent chain.

## Causa

`MediaExporter` dichiara `@mixin PHPFFMpeg`. `addFilter()` esiste solo sul driver ed è inoltrato con `__call`; il PHPDoc del mixin restituisce `self` come `PHPFFMpeg`, perdendo il tipo `MediaExporter` per `save()`.

## Soluzione (preferita)

Non concatenare `addFilter()` dopo `inFormat()`:

```php
$export = FFMpeg::fromDisk($data->disk)
    ->open($data->file)
    ->export()
    ->onProgress(/* ... */)
    ->inFormat($formatInstance);

$export->addFilter('-preset', 'ultrafast');
$export->save($file_new);
```

`save()` è definito su `MediaExporter` (`pbmedia/laravel-ffmpeg`).

## Vietato

- `@phpstan-ignore` su `save()` se basta spezzare la catena
- Chiamare `save()` sul risultato di `->addFilter()` in un’unica espressione
=======
L'action `ConvertVideoByConvertDataAction` usa `ProtoneMedia\LaravelFFMpeg`. Il metodo `save()` sulla catena Export non è riconosciuto da PHPStan.

## Soluzione

Aggiunto `@phpstan-ignore-next-line method.notFound` sulla chiamata a `->save()`:

```php
->addFilter('-preset', 'ultrafast')
// @phpstan-ignore-next-line method.notFound (pbmedia/laravel-ffmpeg Export API)
->save($file_new, $formatInstance);
```

## Motivazione

L'API di pbmedia/laravel-ffmpeg espone `save()` sul builder Export ma PHPStan non la rileva. L'ignore è circoscritto e documentato.
>>>>>>> f6dc2a0 (.)
