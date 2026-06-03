<?php

test('the application returns a successful response', function () {
    $response = $this->getJson('/api/customers');

    $response->assertStatus(200);
});