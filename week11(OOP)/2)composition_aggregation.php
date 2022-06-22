 <pre>
<?php
/*
--> Association:
    -Association is a relation between two separate classes which establishes through their Objects. Association can be one-to-one, one-to-many, many-to-one, many-to-many. In Object-Oriented programming, an Object communicates to another object to use functionality and services provided by that object. Composition and Aggregation are the two forms of association. 

    -example :two separate classes Bank and Employee are associated through their Objects. Bank can have many employees, So it is a one-to-many relationship. 

-->Composition :
    -an object creates another object.
    -Composition is effectively an ownership relationship
    -In composition, the parts can not exist outside the thing that contains them
    - تحتوى على حاجة اساسية لا يمكن الاستغناء عنها
    - composition is a "part-of" relation

    Composition is a restricted form of Aggregation in which two entities are highly dependent on each other :

        -It represents part-of relationship.

        -In composition, both entities are dependent on each other.

        -When there is a composition between two entities, the composed object cannot exist without the other entity.

        example : car consists from engine(component) , tyre(component)

-->Aggregation :
    -occurs when an object is composed of multiple objects
    -aggregation is a “contains” relationship.
    -In aggregation, individual things can exist on their own as unique entities 
    
    -يحتوى على مكون يمكن الاستغناء عنه
    - example : car and driver
    
    It is a special form of Association where:  

        -It represents Has-A’s relationship.
        
        -It is a unidirectional association i.e. a one-way relationship. For example, a department can have students but vice versa is not possible and thus unidirectional in nature.
        
        -In Aggregation, both the entries can survive individually which means ending one entity will not affect the other entity.


////////////////////////////
-->another comparison (Aggregation vs Composition ):

    1. Dependency: Aggregation implies a relationship where the child can exist independently of the parent. For example, Bank and Employee, delete the Bank and the Employee still exist. whereas Composition implies a relationship where the child cannot exist independent of the parent. Example: Human and heart, heart don’t exist separate to a Human

    2. Type of Relationship: Aggregation relation is “has-a” and composition is “part-of” relation.

    3. Type of association: Composition is a strong Association whereas Aggregation is a weak Association.
    
*/
?>
</pre>