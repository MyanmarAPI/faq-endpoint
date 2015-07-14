<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FaqControllerTest extends TestCase {

    public function testFirstFAQpage()
    {
        $response = $this->call('GET', '/faq/v1');
        $this->assertResponseOk();
        $rdata = $response->getData();
        $this->assertEquals(count($rdata->{"data"}), 15);
        $this->assertEquals($rdata->{"meta"}->{"pagination"}->{"current_page"}, 1);
        $this->assertEquals($rdata->{"meta"}->{"pagination"}->{"links"}->{"next"}, "/?page=2");
    }

    public function testSecondFAQpage()
    {
        $response = $this->call('GET', '/faq/v1?page=2');
        $this->assertResponseOk();
        $rdata = $response->getData();
        $this->assertEquals($rdata->{"meta"}->{"pagination"}->{"current_page"}, 2);
        $this->assertEquals($rdata->{"meta"}->{"pagination"}->{"links"}->{"previous"}, "/?page=1");
    }

    public function testIndividualQuestion()
    {
        $all = $this->call('GET', '/faq/v1');
        $question = $all->getData()->{"data"}[0];

        $response = $this->call('GET', '/faq/v1/question/' . $question->{"id"});
        $this->assertResponseOk();
        $qdata = $response->getData()->{"data"};
        $this->assertEquals($question->{"question"}, $qdata->{"question"});
    }

    public function testPerPage()
    {
        $response = $this->call('GET', '/faq/v1?per_page=2');
        $this->assertResponseOk();
        $rdata = $response->getData();
        $this->assertEquals(count($rdata->{"data"}), 2);
    }
}
