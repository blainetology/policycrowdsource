<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::update("ALTER TABLE policies AUTO_INCREMENT = 20000;");
        \App\Policy::create(['name'=>'Constitution', 'short_synopsis'=>'Replacement for the Articles of Confederation','full_synopsis'=>'This is the full synopsis of the proposed policy, with many more details']);

        \DB::update("ALTER TABLE sections AUTO_INCREMENT = 400000;");
        \App\Section::create(['content'=>"We the People of the United States, in Order to form a more perfect Union, establish Justice, insure domestic Tranquility, provide for the common defence, promote the general Welfare, and secure the Blessings of Liberty to ourselves and our Posterity, do ordain and establish this Constitution for the United States of America.", 'policy_id'=>20000, 'user_id'=>100000, 'display_order'=>1]); //400000

        \App\Section::create(['title'=>"Article I - Legislative", 'policy_id'=>20000, 'user_id'=>100000, 'display_order'=>2]); //400001
        \App\Section::create(['title'=>"Article II - Executive", 'policy_id'=>20000, 'user_id'=>100000, 'display_order'=>3]); //400002
        \App\Section::create(['title'=>"Article III - Judicial", 'policy_id'=>20000, 'user_id'=>100000, 'display_order'=>4]); //400003
        \App\Section::create(['title'=>"Article IV - States' Relations", 'policy_id'=>20000, 'user_id'=>100000, 'display_order'=>5]); //400004
        \App\Section::create(['title'=>"Article V - Mode of Amendment", 'policy_id'=>20000, 'user_id'=>100000, 'display_order'=>6]); //400005
        \App\Section::create(['title'=>"Article VI - Prior Debts, National Supremacy, Oaths of Office", 'policy_id'=>20000, 'user_id'=>100000, 'display_order'=>7]); //400006
        \App\Section::create(['title'=>"Article VII - Ratification", 'policy_id'=>20000, 'user_id'=>100000, 'display_order'=>8]); //400007

        \App\Section::create(['title'=>"Section 1", 'content'=>"All legislative Powers herein granted shall be vested in a Congress of the United States, which shall consist of a Senate and House of Representatives.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>1]);
        \App\Section::create(['title'=>"Section 2", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>2]);
        \App\Section::create(['title'=>"Section 3", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>3]);
        \App\Section::create(['title'=>"Section 4", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>4]);
        \App\Section::create(['title'=>"Section 5", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>5]);
        \App\Section::create(['title'=>"Section 6", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>6]);
        \App\Section::create(['title'=>"Section 7", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>7]);
        \App\Section::create(['title'=>"Section 8", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>8]);
        \App\Section::create(['title'=>"Section 9", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>9]);
        \App\Section::create(['title'=>"Section 10", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400001, 'display_order'=>10]);

        \App\Section::create(['title'=>"", 'content'=>"1: The House of Representatives shall be composed of Members chosen every second Year by the People of the several States, and the Electors in each State shall have the Qualifications requisite for Electors of the most numerous Branch of the State Legislature.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>1]);
        \App\Section::create(['title'=>"", 'content'=>"2: No Person shall be a Representative who shall not have attained to the Age of twenty five Years, and been seven Years a Citizen of the United States, and who shall not, when elected, be an Inhabitant of that State in which he shall be chosen.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>2]);
        \App\Section::create(['title'=>"", 'content'=>"3: Representatives and direct Taxes shall be apportioned among the several States which may be included within this Union, according to their respective Numbers, which shall be determined by adding to the whole Number of free Persons, including those bound to Service for a Term of Years, and excluding Indians not taxed, three fifths of all other Persons.2  The actual Enumeration shall be made within three Years after the first Meeting of the Congress of the United States, and within every subsequent Term of ten Years, in such Manner as they shall by Law direct. The Number of Representatives shall not exceed one for every thirty Thousand, but each State shall have at Least one Representative; and until such enumeration shall be made, the State of New Hampshire shall be entitled to chuse three, Massachusetts eight, Rhode-Island and Providence Plantations one, Connecticut five, New-York six, New Jersey four, Pennsylvania eight, Delaware one, Maryland six, Virginia ten, North Carolina five, South Carolina five, and Georgia three.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>3]);
        \App\Section::create(['title'=>"", 'content'=>"4: When vacancies happen in the Representation from any State, the Executive Authority thereof shall issue Writs of Election to fill such Vacancies.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>4]);
        \App\Section::create(['title'=>"", 'content'=>"5: The House of Representatives shall chuse their Speaker and other Officers; and shall have the sole Power of Impeachment.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>5]);

        \App\Section::create(['title'=>"", 'content'=>"1: The Senate of the United States shall be composed of two Senators from each State, chosen by the Legislature thereof,3 for six Years; and each Senator shall have one Vote.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400010, 'display_order'=>1]);
        \App\Section::create(['title'=>"", 'content'=>"2: Immediately after they shall be assembled in Consequence of the first Election, they shall be divided as equally as may be into three Classes. The Seats of the Senators of the first Class shall be vacated at the Expiration of the second Year, of the second Class at the Expiration of the fourth Year, and of the third Class at the Expiration of the sixth Year, so that one third may be chosen every second Year; and if Vacancies happen by Resignation, or otherwise, during the Recess of the Legislature of any State, the Executive thereof may make temporary Appointments until the next Meeting of the Legislature, which shall then fill such Vacancies.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400010, 'display_order'=>2]);
        \App\Section::create(['title'=>"", 'content'=>"3: No Person shall be a Senator who shall not have attained to the Age of thirty Years, and been nine Years a Citizen of the United States, and who shall not, when elected, be an Inhabitant of that State for which he shall be chosen.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400010, 'display_order'=>3]);
        \App\Section::create(['title'=>"", 'content'=>"4: The Vice President of the United States shall be President of the Senate, but shall have no Vote, unless they be equally divided.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400010, 'display_order'=>4]);
        \App\Section::create(['title'=>"", 'content'=>"5: The Senate shall chuse their other Officers, and also a President pro tempore, in the Absence of the Vice President, or when he shall exercise the Office of President of the United States.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400010, 'display_order'=>5]);
        \App\Section::create(['title'=>"", 'content'=>"6: The Senate shall have the sole Power to try all Impeachments. When sitting for that Purpose, they shall be on Oath or Affirmation. When the President of the United States is tried, the Chief Justice shall preside: And no Person shall be convicted without the Concurrence of two thirds of the Members present.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400010, 'display_order'=>6]);
        \App\Section::create(['title'=>"", 'content'=>"7: Judgment in Cases of impeachment shall not extend further than to removal from Office, and disqualification to hold and enjoy any Office of honor, Trust or Profit under the United States: but the Party convicted shall nevertheless be liable and subject to Indictment, Trial, Judgment and Punishment, according to Law.", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400010, 'display_order'=>7]);
        
        \App\Section::create(['title'=>"", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>1]);
        \App\Section::create(['title'=>"", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>1]);
        \App\Section::create(['title'=>"", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>1]);
        \App\Section::create(['title'=>"", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>1]);
        \App\Section::create(['title'=>"", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>1]);
        \App\Section::create(['title'=>"", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>1]);
        \App\Section::create(['title'=>"", 'content'=>"", 'policy_id'=>20000, 'user_id'=>100000, 'parent_section_id'=>400009, 'display_order'=>1]);

    }
}
