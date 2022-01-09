<?php

namespace App\Tests\src\Search\Application\WordSearch;

use App\Application\WordSearch\WordSearch;
use App\Application\WordSearch\WordSearchQueryHandler;
use App\Tests\src\Search\Domain\SearchUnitTestCase;
use App\Tests\src\Search\Domain\SearchWasCreatedMother;
use App\Tests\src\Search\Domain\WordSearchQueryMother;

class WordSearchQueryHandlerTest extends SearchUnitTestCase
{
    private WordSearchQueryHandler $handler;
    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = new WordSearchQueryHandler(
            new WordSearch(
                $this->apiRequest(),
                $this->eventBus()
            )
        );
    }

    /** @test */
    public function should_get_word_result()
    {
        $result = ['query'];
        $query = WordSearchQueryMother::create('word');
        $this->shouldReturnWordedSearch($result);
        $this->shouldDispatchDomainEvent(SearchWasCreatedMother::create($result));

        $this->assertEquals($result, $this->handler->__invoke($query));
    }

    public function invalidWords(): array
    {
        return [
            [';DROP TABLES'],
            ['·$"$%%"ANTONIO%·$%·'],
            ['<script type="text/javascript">document.location="veryshadywebsite";</script>']
        ];
    }

    /**
     * @dataProvider invalidWords
     * @test
     */
    public function should_sanitize_word_inputs(
        string $invalidWord
    )
    {
        $word = filter_var($invalidWord, FILTER_SANITIZE_STRING);
        $result = [$word];
        $query = WordSearchQueryMother::create($invalidWord);
        $this->shouldReturnWordedSearch($result);
        $this->shouldDispatchDomainEvent(SearchWasCreatedMother::create($result));

        $this->assertEquals($result, $this->handler->__invoke($query));
    }
}
