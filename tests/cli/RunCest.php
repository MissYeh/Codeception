<?php

class RunCest
{

    public function _before(\Codeception\Scenario $scenario)
    {
        if (floatval(phpversion()) == '5.3') $scenario->skip();
    }

    public function runHtml(\CliGuy $I) {
        $I->wantTo('execute tests with html output');
        $I->amInPath('tests/data/sandbox');
        $I->executeCommand('run dummy --html');
        $I->seeFileFound('report.html','tests/_log');
    }

    public function runJsonReport(\CliGuy $I)
    {
        $I->wantTo('check json reports');
        $I->amInPath('tests/data/sandbox');
        $I->executeCommand('run dummy --json');
        $I->seeFileFound('report.json','tests/_log');
        $I->seeInThisFile('"suite":');
        $I->seeInThisFile('"dummy"');
    }

    public function runTapReport(\CliGuy $I)
    {
        $I->wantTo('check tap reports');
        $I->amInPath('tests/data/sandbox');
        $I->executeCommand('run dummy --tap');
        $I->seeFileFound('report.tap.log','tests/_log');
    }

    public function runXmlReport(\CliGuy $I)
    {
        $I->wantTo('check xml reports');
        $I->amInPath('tests/data/sandbox');
        $I->executeCommand('run dummy --xml');
        $I->seeFileFound('report.xml','tests/_log');
        $I->seeInThisFile('<?xml');
        $I->seeInThisFile('<testsuite name="dummy"');
        $I->seeInThisFile('<testcase file="FileExistsCept.php"');
    }

}