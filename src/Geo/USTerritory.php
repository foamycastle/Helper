<?php
/*
 *  Author: Aaron Sollman
 *  Email:  unclepong@gmail.com
 *  Date:   11/14/25
 *  Time:   5:08
*/


namespace Foamycastle\Utilities\Geo;

enum USTerritory: string
{
    // States
    case ALABAMA = 'Alabama';
    case ALASKA = 'Alaska';
    case ARIZONA = 'Arizona';
    case ARKANSAS = 'Arkansas';
    case CALIFORNIA = 'California';
    case COLORADO = 'Colorado';
    case CONNECTICUT = 'Connecticut';
    case DELAWARE = 'Delaware';
    case FLORIDA = 'Florida';
    case GEORGIA = 'Georgia';
    case HAWAII = 'Hawaii';
    case IDAHO = 'Idaho';
    case ILLINOIS = 'Illinois';
    case INDIANA = 'Indiana';
    case IOWA = 'Iowa';
    case KANSAS = 'Kansas';
    case KENTUCKY = 'Kentucky';
    case LOUISIANA = 'Louisiana';
    case MAINE = 'Maine';
    case MARYLAND = 'Maryland';
    case MASSACHUSETTS = 'Massachusetts';
    case MICHIGAN = 'Michigan';
    case MINNESOTA = 'Minnesota';
    case MISSISSIPPI = 'Mississippi';
    case MISSOURI = 'Missouri';
    case MONTANA = 'Montana';
    case NEBRASKA = 'Nebraska';
    case NEVADA = 'Nevada';
    case NEW_HAMPSHIRE = 'New Hampshire';
    case NEW_JERSEY = 'New Jersey';
    case NEW_MEXICO = 'New Mexico';
    case NEW_YORK = 'New York';
    case NORTH_CAROLINA = 'North Carolina';
    case NORTH_DAKOTA = 'North Dakota';
    case OHIO = 'Ohio';
    case OKLAHOMA = 'Oklahoma';
    case OREGON = 'Oregon';
    case PENNSYLVANIA = 'Pennsylvania';
    case RHODE_ISLAND = 'Rhode Island';
    case SOUTH_CAROLINA = 'South Carolina';
    case SOUTH_DAKOTA = 'South Dakota';
    case TENNESSEE = 'Tennessee';
    case TEXAS = 'Texas';
    case UTAH = 'Utah';
    case VERMONT = 'Vermont';
    case VIRGINIA = 'Virginia';
    case WASHINGTON = 'Washington';
    case WEST_VIRGINIA = 'West Virginia';
    case WISCONSIN = 'Wisconsin';
    case WYOMING = 'Wyoming';

    // Federal District
    case DISTRICT_OF_COLUMBIA = 'District of Columbia';

    // Inhabited Territories
    case AMERICAN_SAMOA = 'American Samoa';
    case GUAM = 'Guam';
    case NORTHERN_MARIANA_ISLANDS = 'Northern Mariana Islands';
    case PUERTO_RICO = 'Puerto Rico';
    case US_VIRGIN_ISLANDS = 'U.S. Virgin Islands';

    // Minor Outlying Islands (Uninhabited)
    case BAKER_ISLAND = 'Baker Island';
    case HOWLAND_ISLAND = 'Howland Island';
    case JARVIS_ISLAND = 'Jarvis Island';
    case JOHNSTON_ATOLL = 'Johnston Atoll';
    case KINGMAN_REEF = 'Kingman Reef';
    case MIDWAY_ATOLL = 'Midway Atoll';
    case NAVASSA_ISLAND = 'Navassa Island';
    case PALMYRA_ATOLL = 'Palmyra Atoll';
    case WAKE_ISLAND = 'Wake Island';
}
