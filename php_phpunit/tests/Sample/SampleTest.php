<?php

use Vegitable\Version;

class SampleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sample
     */
    private $obj;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {

    }

    /**
     * @test
     */
    public function JDK7u40ならば妥当なバージョンとするべき()
    {
        $this->assertTrue(Version::isValid('JDK7u40'));
    }

    /**
     * @test
     */
    public function hogeならば無効なバージョンとするべき()
    {
        $this->assertFalse(Version::isValid('hoge'));
    }
    /**
     * @test
     */
    public function JDK7u41ならば妥当なバージョンとするべき()
    {
        $this->assertTrue(Version::isValid('JDK7u41'));
    }
    /**
     * @test
     */
    public function JDK7u9999999999999ならば妥当なバージョンとするべき()
    {
        $this->assertTrue(Version::isValid('JDK7u9999999999999'));
    }

    /**
     * @test
     */
    public function JDK7u40ならばfamilyNUmberが7、updateNumberが40であるべき()
    {
        $sut = Version::parse('JDK7u40');
        $this->assertEquals($sut->familyNumber,7);
        $this->assertEquals($sut->updateNumber,40);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function JDK7U40ならばInvalidArgumentExceptionが発生すべき()
    {
        Version::parse('JDK7U40');
    }

    /**
     * @test
     */
    public function JDK7u40はJDK7u41より小さいべき()
    {
        $u40 = Version::parse('JDK7u40');
        $u41 = Version::parse('JDK7u41');

        $this->assertTrue($u40->lt($u41));
    }

    /**
     * @test
     */
    public function JDK7u50ならばJDK7u40より大きいべき()
    {
        $u40 = Version::parse('JDK7u40');
        $u50 = Version::parse('JDK7u50');

        $this->assertTrue($u50->gt($u40));
    }

    /**
     * @test
     */
    public function JDK7u51ならばJDK8u0より小さいべき()
    {
        $f7 = Version::parse('JDK7u51');
        $f8 = Version::parse('JDK8u0');

        $this->assertTrue($f7->lt($f8));
    }

    /**
     * @test
     */
    public function JDK8u0ならばJDK7u51より大きいべき()
    {
        $f7 = Version::parse('JDK7u51');
        $f8 = Version::parse('JDK8u0');

        $this->assertTrue($f8->gt($f7));
    }

    /**
     * @test
     */
    public function JDK7u40ならばLUは60であるべき()
    {
        $current = Version::parse('JDK7u40');
        $new = $current->nextLimitedUpdate();

        $this->assertEquals($new->updateNumber, 60);
    }

    /**
     * @test
     */
    public function JDK7u40ならばCPUは45であるべき()
    {
        $current = Version::parse('JDK7u40');
        $new = $current->nextCriticalPatchUpdate();

        $this->assertEquals($new->updateNumber, 45);
    }

    /**
     * @test
     */
    public function JDK7u40ならばSAは41であるべき()
    {
        $current = Version::parse('JDK7u40');
        $new = $current->nextSecurityAlert();

        $this->assertEquals($new->updateNumber, 41);
    }


    public function testRegexp(){
        preg_match('/^JDK7u([0-9]+)$/', 'JDK7u41', $matches);
        // echo $matches[1];
        $this->assertEquals($matches[1], '41');
    }
}
