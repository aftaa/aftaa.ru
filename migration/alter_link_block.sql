alter table link_block
    add column private bool not null default true after name;