"use strict";
var fs = require("fs");
const hyphenopoly = require("hyphenopoly");

const hyphenator = hyphenopoly.config({
    "require": ["de", "en-us", "it"],
    "hyphen": "•",
    "exceptions": {
        "en-us": "en-han-ces"
    }
});
async function hyphenate_en(text) {
    const hyphenateText = await hyphenator.get("en-us");
    console.log(hyphenateText(text));
}

async function hyphenate_de(text) {
    const hyphenateText = await hyphenator.get("de");
    console.log(hyphenateText(text));
}

async function hyphenate_it(text) {
    const hyphenateText = await hyphenator.get("it");
	let words= fs.readFileSync('words.txt', 'utf8');
	words=words.split(/\r\n/);
	let output='';
	for(let i=0;i<words.length;i++){
		output+=words[i]+"\t"+hyphenateText(words[i])+"\n";
		console.log(hyphenateText(words[i]));
	}
	fs.writeFileSync("output.txt",output);
    //console.log(hyphenateText(text));
}
//hyphenate_en("hyphenation enhances justification.");
//hyphenate_de("Silbentrennung verbessert den Blocksatz.");
//hyphenate_it("Lasciatemi cantare");
hyphenate_it('x');