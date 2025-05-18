<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use OpenTelemetry\SDK\Trace\TracerProvider;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\SDK\Trace\SpanExporter\ConsoleSpanExporterFactory;

class Tracing
{
    private static ?\OpenTelemetry\API\Trace\TracerInterface $tracer = null;

    public static function getTracer(): \OpenTelemetry\API\Trace\TracerInterface
    {
        if (self::$tracer === null) {
            $tracerProvider = new TracerProvider(
                new SimpleSpanProcessor(
                    (new ConsoleSpanExporterFactory())->create()
                )
            );
            self::$tracer = $tracerProvider->getTracer('local-php-app');
        }
        return self::$tracer;
    }
}
