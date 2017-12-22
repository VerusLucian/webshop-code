<?php

use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $housesList = ['Variable Vikings','Database Dragons','Recursive Ravens','Script Serpents'];
        $houseSlogan = ['As the last remnants of the Old World, these humans still fight for bringing back the world they lost in the big apocalypse better known as the ‘Stack Overflow’. Few humans survived thanks to a powerful exception handler built by the hands of the Variable Vikings. Now they seek revenge. The Variable Vikings are known of using every tool at their disposal, whether this is Javascript, Python, Lua, or the old world ‘legendary languages’ such as C, Cobol, Delphi, Pascal and Basic.',
            'Armed with the most vicious of queries, the database dragons leave no table unjoined in ‘The Coding Conflict’. They do not care about the eternal debate because they know good storage of data is the primary key to succes. The database dragons fight for more use of views and triggers so only selected warriors have access to their wisdom. They believe in a world of structure and relations. Protecting the integrity of the data, normalized and lined up in rows and colums, the Database Dragons are a force to be reckoned with.',
            'Legend says if you see a Recursive Raven use code, you get trapped into the arms of the endless repeating twilight. Armed with a very powerful language called C#, they were the inititiator of the apocalypse of the Old World, better known as the ‘Stack Overflow’, leaving the Old World flooded with data, and cause the beginning of the new Era, the kingdom of Null. With their gigantic command control called ‘Visual Studio’, they are the current commanders of Null.',
            'Vile creatures from the underworld code labyrinth. In the ‘old world’ also referred to as ‘Spaghetti code’. In ‘The Coding Conflict’ they get the job done fast as they rush into enemy territory, leaving an untraceable mess with the use of their extremely powerful PHP functions such as explode() and chop(). World Anarchy is their aspiration, and they seek to array_split() the world into fragments.'];
        for( $i = 0 ; $i < count($housesList) ; $i++ )
        {
            DB::table('houses')->insert
            (
                [
                    'name' => $housesList[$i],
                    'description' => $houseSlogan[$i],
                ]
            );
        }
    }
}
