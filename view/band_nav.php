
        <nav>
            <ul>
                <!-- display links for all categories -->
                <?php foreach($bands as $band) : ?>
                <li>
                    <a href="?band_id=<?php 
                              echo $band['bandID']; ?>">
                        <?php echo $band['bandName']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

