<?php
/**
 * Created by PhpStorm.
 * User: mmoore
 * Date: 8/21/18
 * Time: 11:48 AM
 */

namespace DevelopingSonder\PropublicaCongress\tests;
use DevelopingSonder\PropublicaCongress\Helpers\VotesCollection;
use DevelopingSonder\PropublicaCongress\Members;
use DevelopingSonder\PropublicaCongress\Resources\Member;
use DevelopingSonder\PropublicaCongress\Resources\Vote;
use PHPUnit\Framework\TestCase;
use DevelopingSonder\PropublicaCongress\Client;
use Illuminate\Support\Collection;
use Dotenv\Dotenv;

class MembersTest extends TestCase
{

    public function testMembersClientCreation()
    {
        $loader = new Dotenv(__DIR__ . "/../");
        $loader->load();

        $membersClient = new Members();
        $this->assertInstanceOf(Members::class, $membersClient);

        return $membersClient;
    }


    /**
     * @depends testMembersClientCreation
     * @param Members $membersClient
     * @return mixed
     * @throws
     */
    public function testGetMembers(Members $membersClient)
    {
        $members = $membersClient->members('116', 'house');
        $this->assertInstanceOf(Collection::class, $members);
        $this->assertGreaterThan(0, $members->count());

        return $members;
    }

    /**
     * @depends testGetMembers
     * @param Collection $members
     */
    public function testMemberResourceCreation(Collection $members)
    {
        $member = $members->first();
        $this->assertInstanceOf(Member::class, $member);
    }

    /**
     * @depends testMembersClientCreation
     * @param Members $membersClient
     * @throws \Exception
     */
    public function testGetLeavingMembers(Members $membersClient)
    {
        $members = $membersClient->leavingMembers('116', 'house');
        $this->assertInstanceOf(Collection::class, $members);
    }


    /**
     * @depends testMembersClientCreation
     * @depends testGetMembers
     *
     * @param Members $memberClient
     * @param Collection $members
     * @throws \Exception
     */
    public function testMemberVotePositions(Members $memberClient, Collection $members)
    {
        $member = $members->first();
        $member = $memberClient->memberVotePositions($member->id);

        $this->assertInstanceOf(Member::class, $member);
        $this->assertInstanceOf(VotesCollection::class, $member->votes);
        $this->assertInstanceOf(Vote::class, $member->votes->first());
    }
}