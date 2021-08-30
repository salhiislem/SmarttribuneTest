<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ExporterService
{
public function buildCsvFile(string $table_name, array $table_data, array $attributes){

    if (!$table_data) return("Couldn't fetch records");
    $defaultContext = [
        AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
            return $object->getId();
        },
    ];
    $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
    $encoder = new CsvEncoder();
    $serializer = new Serializer([new DateTimeNormalizer(), $normalizer], [$encoder]);
    $csvContent = $serializer->serialize($table_data, 'csv',[AbstractNormalizer::ATTRIBUTES => $attributes]);
    $response = new Response($csvContent);
    $response->headers->set('Content-Encoding', 'UTF-8');
    $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
    $response->headers->set('Content-Disposition', 'attachment; filename='.$table_name.'.csv');
    return $response;
}
}