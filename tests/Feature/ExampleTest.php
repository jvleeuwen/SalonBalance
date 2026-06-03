<?php

test('the application returns a successful response', function () {
    $response = $this->get(route('customers.index'));

    $response->assertViewIs('customers.index');
});
