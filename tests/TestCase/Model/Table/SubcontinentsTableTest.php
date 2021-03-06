<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubcontinentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubcontinentsTable Test Case
 */
class SubcontinentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubcontinentsTable
     */
    public $Subcontinents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subcontinents',
        'app.continents',
        'app.countries',
        'app.cities',
        'app.projects',
        'app.users',
        'app.genres',
        'app.organization_types',
        'app.project_stages',
        'app.categories',
        'app.categories_projects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Subcontinents') ? [] : ['className' => 'App\Model\Table\SubcontinentsTable'];
        $this->Subcontinents = TableRegistry::get('Subcontinents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subcontinents);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
