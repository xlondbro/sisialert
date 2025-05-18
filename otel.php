<?php
require_once 'vendor/autoload.php';

use OpenTelemetry\SDK\Trace\TracerProvider;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\Contrib\Otlp\Exporter;

$collectorEndpoint = 'http://10.20.90.102:8080/v1/traces'; // Ganti IP ini

$exporter = new Exporter('default', $collectorEndpoint);
$tracerProvider = new TracerProvider(
    new SimpleSpanProcessor($exporter)
);

$tracer = $tracerProvider->getTracer('php-native-app');

// Mulai span utama
$span = $tracer->spanBuilder('page-request')->startSpan();
$span->setAttribute('path', $_SERVER['REQUEST_URI']);
$span->setAttribute('method', $_SERVER['REQUEST_METHOD']);

$span->end();
$tracerProvider->shutdown();