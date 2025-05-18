<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use OpenTelemetry\SDK\Trace\TracerProvider;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\Contrib\OtlpGrpc\OtlpGrpcExporter; // Pastikan sudah install paket ini

class Tracing
{
    private static ?\OpenTelemetry\API\Trace\TracerInterface $tracer = null;

    public static function getTracer(): \OpenTelemetry\API\Trace\TracerInterface
    {
        if (self::$tracer === null) {
            // Buat OTLP gRPC Exporter ke Signoz Collector
            $exporter = new OtlpGrpcExporter(
                endpoint: 'http://10.20.90.102:4317' // ganti sesuai alamat Signoz Collector-mu
            );

            $tracerProvider = new TracerProvider(
                new SimpleSpanProcessor($exporter)
            );

            self::$tracer = $tracerProvider->getTracer('io.signoz.php.app');
        }
        return self::$tracer;
    }
}
