-- Update readings for additional Jidoushi (intransitive) verbs
UPDATE kotobas SET reading = 'こわれる' WHERE japanese = '壊れる';
UPDATE kotobas SET reading = 'たまる' WHERE japanese = 'たまる';
UPDATE kotobas SET reading = 'つく' WHERE japanese = 'つく';
UPDATE kotobas SET reading = 'とどく' WHERE japanese = '届く';
UPDATE kotobas SET reading = 'とれる' WHERE japanese = '取れる';
UPDATE kotobas SET reading = 'なくなる' WHERE japanese = 'なくなる';
UPDATE kotobas SET reading = 'ひえる' WHERE japanese = '冷える';
UPDATE kotobas SET reading = 'みつかる' WHERE japanese = '見つかる';
UPDATE kotobas SET reading = 'やぶれる' WHERE japanese = '破れる';
UPDATE kotobas SET reading = 'よごれる' WHERE japanese = '汚れる';
UPDATE kotobas SET reading = 'われる' WHERE japanese = '割れる';

-- Update readings for additional Tadoushi (transitive) verbs
UPDATE kotobas SET reading = 'こわす' WHERE japanese = '壊す';
UPDATE kotobas SET reading = 'ためる' WHERE japanese = 'ためる';
UPDATE kotobas SET reading = 'つける' WHERE japanese = 'つける';
UPDATE kotobas SET reading = 'とどける' WHERE japanese = '届ける';
UPDATE kotobas SET reading = 'とる' WHERE japanese = '取る';
UPDATE kotobas SET reading = 'なくす' WHERE japanese = 'なくす';
UPDATE kotobas SET reading = 'ひやす' WHERE japanese = '冷やす';
UPDATE kotobas SET reading = 'みつける' WHERE japanese = '見つける';
UPDATE kotobas SET reading = 'やぶる' WHERE japanese = '破る';
UPDATE kotobas SET reading = 'よごす' WHERE japanese = '汚す';
UPDATE kotobas SET reading = 'わる' WHERE japanese = '割る';
