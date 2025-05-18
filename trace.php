<?php
require_once 'tracing.php';

use OpenTelemetry\API\Trace\SpanKind;

$tracer = Tracing::getTracer();

$span = $tracer->spanBuilder('test_span')->setSpanKind(SpanKind::KIND_INTERNAL)->startSpan();
echo "Hello OpenTelemetry\n";
$span->end();
